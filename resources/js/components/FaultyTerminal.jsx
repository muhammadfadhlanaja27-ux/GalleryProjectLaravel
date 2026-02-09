import { Renderer, Program, Mesh, Color, Triangle } from 'ogl';
import { useEffect, useRef, useMemo, useCallback } from 'react';
import './FaultyTerminal.css';

const vertexShader = `
attribute vec2 position;
attribute vec2 uv;
varying vec2 vUv;
void main() {
  vUv = uv;
  gl_Position = vec4(position, 0.0, 1.0);
}
`;

const fragmentShader = `
precision mediump float;
varying vec2 vUv;
uniform float iTime;
uniform vec3  iResolution;
uniform float uScale;
uniform vec2  uGridMul;
uniform float uDigitSize;
uniform float uScanlineIntensity;
uniform float uGlitchAmount;
uniform float uFlickerAmount;
uniform float uNoiseAmp;
uniform float uChromaticAberration;
uniform float uDither;
uniform float uCurvature;
uniform vec3  uTint;
uniform vec2  uMouse;
uniform float uMouseStrength;
uniform float uUseMouse;
uniform float uPageLoadProgress;
uniform float uUsePageLoadAnimation;
uniform float uBrightness;

float time;

float hash21(vec2 p){
  p = fract(p * 234.56);
  p += dot(p, p + 34.56);
  return fract(p.x * p.y);
}

float noise(vec2 p) {
  return sin(p.x * 10.0) * sin(p.y * (3.0 + sin(time * 0.090909))) + 0.2; 
}

mat2 rotate(float angle) {
  float c = cos(angle); float s = sin(angle);
  return mat2(c, -s, s, c);
}

float fbm(vec2 p) {
  p *= 1.1;
  float f = 0.0;
  float amp = 0.5 * uNoiseAmp;
  f += amp * noise(p);
  p = rotate(time * 0.02) * p * 2.0;
  amp *= 0.454545;
  f += amp * noise(p);
  return f;
}

float pattern(vec2 p, out vec2 q, out vec2 r) {
  q = vec2(fbm(p + vec2(1.0)), fbm(rotate(0.1 * time) * p + vec2(1.0)));
  r = vec2(fbm(rotate(0.1) * q), fbm(q));
  return fbm(p + r);
}

float digit(vec2 p){
    vec2 grid = uGridMul * 15.0;
    vec2 s = floor(p * grid) / grid;
    p = p * grid;
    vec2 q, r;
    float intensity = pattern(s * 0.1, q, r) * 1.3 - 0.03;
    
    if(uUseMouse > 0.5){
        vec2 mouseWorld = uMouse * uScale;
        float distToMouse = distance(s, mouseWorld);
        intensity += exp(-distToMouse * 8.0) * uMouseStrength * 10.0;
    }
    
    if(uUsePageLoadAnimation > 0.5){
        float cellRandom = fract(sin(dot(s, vec2(12.9898, 78.233))) * 43758.5453);
        intensity *= smoothstep(0.0, 1.0, clamp((uPageLoadProgress - cellRandom * 0.8) / 0.2, 0.0, 1.0));
    }
    
    p = fract(p) * uDigitSize;
    float n = pow(floor(p.y * 5.0) - 2.0, 2.0) + pow(floor(p.x * 5.0) - 2.0, 2.0);
    float isOn = step(0.1, intensity - n * 0.0625);
    return step(0.0, p.x) * step(p.x, 1.0) * step(0.0, p.y) * step(p.y, 1.0) * isOn * (0.2 + fract(p.y * 5.0) * 0.8);
}

float displace(vec2 look) {
    float y = look.y - mod(iTime * 0.25, 1.0);
    return sin(look.y * 20.0 + iTime) * 0.0125 * step(0.8, sin(iTime + 4.0 * cos(iTime * 2.0))) * (1.0 / (1.0 + 50.0 * y * y));
}

vec3 getColor(vec2 p){
    float bar = step(mod(p.y + time * 20.0, 1.0), 0.2) * 0.4 * uScanlineIntensity + 1.0;
    p.x += displace(p) * uGlitchAmount;
    float middle = digit(p);
    return (vec3(0.9) * middle + digit(p + 0.002) * 0.1) * bar;
}

void main() {
    time = iTime * 0.333333;
    vec2 uv = vUv;
    if(uCurvature != 0.0){
      vec2 c = uv * 2.0 - 1.0;
      uv = (c * (1.0 + uCurvature * dot(c, c))) * 0.5 + 0.5;
    }
    vec3 col = getColor(uv * uScale) * uTint * uBrightness;
    gl_FragColor = vec4(col, 1.0);
}
`;

function hexToRgb(hex) {
  let h = hex.replace('#', '').trim();
  if (h.length === 3) h = h.split('').map(c => c + c).join('');
  const num = parseInt(h, 16);
  return [((num >> 16) & 255) / 255, ((num >> 8) & 255) / 255, (num & 255) / 255];
}

export default function FaultyTerminal({
  scale = 1, gridMul = [2, 1], digitSize = 1.5, timeScale = 0.3, pause = false,
  scanlineIntensity = 0.3, glitchAmount = 1, flickerAmount = 1, noiseAmp = 0,
  chromaticAberration = 0, dither = 0, curvature = 0.2, tint = '#ffffff',
  mouseReact = true, mouseStrength = 0.2, dpr = 1, pageLoadAnimation = true,
  brightness = 1, className = "", style = {}
}) {
  const containerRef = useRef(null);
  const mouseRef = useRef({ x: 0.5, y: 0.5 });
  const tintVec = useMemo(() => hexToRgb(tint), [tint]);

  useEffect(() => {
    const ctn = containerRef.current;
    if (!ctn) return;

    const renderer = new Renderer({ dpr });
    const gl = renderer.gl;
    const program = new Program(gl, {
      vertex: vertexShader,
      fragment: fragmentShader,
      uniforms: {
        iTime: { value: 0 },
        iResolution: { value: new Color(gl.canvas.width, gl.canvas.height, 1) },
        uScale: { value: scale },
        uGridMul: { value: new Float32Array(gridMul) },
        uDigitSize: { value: digitSize },
        uScanlineIntensity: { value: scanlineIntensity },
        uGlitchAmount: { value: glitchAmount },
        uFlickerAmount: { value: flickerAmount },
        uNoiseAmp: { value: noiseAmp },
        uChromaticAberration: { value: chromaticAberration },
        uDither: { value: dither },
        uCurvature: { value: curvature },
        uTint: { value: new Color(...tintVec) },
        uMouse: { value: new Float32Array([0.5, 0.5]) },
        uMouseStrength: { value: mouseStrength },
        uUseMouse: { value: mouseReact ? 1 : 0 },
        uPageLoadProgress: { value: pageLoadAnimation ? 0 : 1 },
        uUsePageLoadAnimation: { value: pageLoadAnimation ? 1 : 0 },
        uBrightness: { value: brightness }
      }
    });

    const mesh = new Mesh(gl, { geometry: new Triangle(gl), program });
    ctn.appendChild(gl.canvas);

    const resize = () => {
      renderer.setSize(ctn.offsetWidth, ctn.offsetHeight);
      program.uniforms.iResolution.value.set(gl.canvas.width, gl.canvas.height, 1);
    };
    window.addEventListener('resize', resize);
    resize();

    let raf;
    const update = t => {
      raf = requestAnimationFrame(update);
      if (!pause) program.uniforms.iTime.value = t * 0.001 * timeScale;
      if (mouseReact) {
          program.uniforms.uMouse.value[0] += (mouseRef.current.x - program.uniforms.uMouse.value[0]) * 0.1;
          program.uniforms.uMouse.value[1] += (mouseRef.current.y - program.uniforms.uMouse.value[1]) * 0.1;
      }
      if (pageLoadAnimation) program.uniforms.uPageLoadProgress.value = Math.min(t * 0.0005, 1);
      renderer.render({ scene: mesh });
    };
    raf = requestAnimationFrame(update);

    const onMove = e => {
      const r = ctn.getBoundingClientRect();
      mouseRef.current = { x: (e.clientX - r.left) / r.width, y: 1 - (e.clientY - r.top) / r.height };
    };
    if (mouseReact) ctn.addEventListener('mousemove', onMove);

    return () => {
      cancelAnimationFrame(raf);
      window.removeEventListener('resize', resize);
      ctn.removeEventListener('mousemove', onMove);
      if (gl.canvas.parentElement) ctn.removeChild(gl.canvas);
    };
  }, [tintVec]);

  return <div ref={containerRef} className={`faulty-terminal-container ${className}`} style={style} />;
}