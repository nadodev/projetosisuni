// Accessibility Functions
let currentFontSize = 1;
let highContrastEnabled = false;
let screenReaderEnabled = false;
let reducedMotionEnabled = false;

// Toggle high contrast mode
function toggleHighContrast() {
    highContrastEnabled = !highContrastEnabled;
    document.body.classList.toggle('high-contrast');
    
    if (highContrastEnabled) {
        document.body.style.backgroundColor = '#000';
        document.body.style.color = '#fff';
        localStorage.setItem('highContrast', 'true');
    } else {
        document.body.style.backgroundColor = '';
        document.body.style.color = '';
        localStorage.setItem('highContrast', 'false');
    }
}

// Increase font size
function increaseFontSize() {
    if (currentFontSize < 1.5) {
        currentFontSize += 0.1;
        document.body.style.fontSize = `${currentFontSize}rem`;
        localStorage.setItem('fontSize', currentFontSize);
    }
}
function fontOriginal() {
    this.fontSize = '1rem';
this.applyFontSize();
this.savePreferences();
}

// Decrease font size
function decreaseFontSize() {
    if (currentFontSize > 0.8) {
        currentFontSize -= 0.1;
        document.body.style.fontSize = `${currentFontSize}rem`;
        localStorage.setItem('fontSize', currentFontSize);
    }
}

// Toggle screen reader
function toggleScreenReader() {
    screenReaderEnabled = !screenReaderEnabled;
    
    if (screenReaderEnabled) {
        // Add ARIA labels and roles
        document.querySelectorAll('button, a, input, [role="button"]').forEach(element => {
            if (!element.getAttribute('aria-label')) {
                element.setAttribute('aria-label', element.textContent.trim());
            }
        });
        
        // Announce screen reader mode
        const announcement = document.createElement('div');
        announcement.setAttribute('role', 'alert');
        announcement.setAttribute('aria-live', 'polite');
        announcement.textContent = 'Leitor de tela ativado';
        document.body.appendChild(announcement);
        
        setTimeout(() => announcement.remove(), 1000);
        localStorage.setItem('screenReader', 'true');
    } else {
        localStorage.setItem('screenReader', 'false');
    }
}

// Toggle reduced motion
function toggleReducedMotion() {
    reducedMotionEnabled = !reducedMotionEnabled;
    document.body.classList.toggle('reduced-motion');
    
    if (reducedMotionEnabled) {
        document.body.style.setProperty('--transition-duration', '0.01s');
        localStorage.setItem('reducedMotion', 'true');
    } else {
        document.body.style.setProperty('--transition-duration', '0.3s');
        localStorage.setItem('reducedMotion', 'false');
    }
}

// Initialize accessibility features
document.addEventListener('DOMContentLoaded', () => {
    // Load saved preferences
    const savedHighContrast = localStorage.getItem('highContrast');
    const savedFontSize = localStorage.getItem('fontSize');
    const savedScreenReader = localStorage.getItem('screenReader');
    const savedReducedMotion = localStorage.getItem('reducedMotion');

    if (savedHighContrast === 'true') {
        toggleHighContrast();
    }

    if (savedFontSize) {
        currentFontSize = parseFloat(savedFontSize);
        document.body.style.fontSize = `${currentFontSize}rem`;
    }

    if (savedScreenReader === 'true') {
        toggleScreenReader();
    }

    if (savedReducedMotion === 'true') {
        toggleReducedMotion();
    }

    // Add keyboard navigation support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', () => {
        document.body.classList.remove('keyboard-navigation');
    });
});

// Adicione a função global:
window.fontOriginal = function() {
    currentFontSize = 1;
    document.body.style.fontSize = '1rem';
    localStorage.removeItem('fontSize');
};

window.fontOriginal = fontOriginal; 