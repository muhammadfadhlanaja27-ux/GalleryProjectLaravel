// resources/js/app.jsx
import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import BounceCards from './components/BounceCards.jsx';
import FaultyTerminal from './components/FaultyTerminal.jsx';

const container = document.getElementById('bounce-cards-root');

if (container) {
    // Mengambil data dari atribut Blade tadi
    const rawData = container.getAttribute('data-images');
    const imagesFromDatabase = JSON.parse(rawData || "[]");

    // Fallback: Jika database kosong, pakai gambar default agar tidak error
    const finalImages = imagesFromDatabase.length > 0 ? imagesFromDatabase : [
        "https://picsum.photos/400/400?grayscale",
        "https://picsum.photos/400/400?grayscale"
    ];

    const root = createRoot(container);
    root.render(
        <BounceCards
            images={finalImages}
            containerWidth={500}
            containerHeight={300}
            animationDelay={1}
            animationStagger={0.08}
            easeType="elastic.out(1, 0.5)"
            enableHover={true}
        />
    );
}

const terminalRoot = document.getElementById('faulty-terminal-background');
if (terminalRoot) {
    createRoot(terminalRoot).render(
        <FaultyTerminal
            scale={2.2}
            gridMul={[2, 1]}
            digitSize={1.2}
            timeScale={0.5}
            pause={false}
            scanlineIntensity={0.5}
            glitchAmount={1}
            flickerAmount={1}
            noiseAmp={1}
            chromaticAberration={0}
            dither={0}
            curvature={0.14}
            tint="#ef9eef"
            mouseReact={true}
            mouseStrength={0.5}
            pageLoadAnimation={true}
            brightness={0.6}
        />
    );
}

window.addEventListener('scroll', function() {
    const header = document.querySelector('#header');
    if (header) {
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    }
});