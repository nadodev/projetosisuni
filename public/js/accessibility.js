class Accessibility {
    constructor() {
        this.fontSize = 16; // Default font size
        this.highContrast = false;
        this.loadPreferences();
    }

    loadPreferences() {
        const savedPreferences = localStorage.getItem('accessibility_preferences');
        if (savedPreferences) {
            const preferences = JSON.parse(savedPreferences);
            this.fontSize = preferences.fontSize || 16;
            this.highContrast = preferences.highContrast || false;
            this.applyFontSize();
            this.applyHighContrast();
        }
    }

    savePreferences() {
        const preferences = {
            fontSize: this.fontSize,
            highContrast: this.highContrast,
        };
        localStorage.setItem('accessibility_preferences', JSON.stringify(preferences));
    }

    fontOriginal() {
        this.fontSize = 16;
        this.applyFontSize();
        this.savePreferences();
    }

    increaseFontSize() {
        const newSize = this.fontSize + 2;
        this.fontSize = Math.min(newSize, 34);
        this.applyFontSize();
        this.savePreferences();
    }

    decreaseFontSize() {
        const newSize = this.fontSize - 2;
        this.fontSize = Math.max(newSize, 12);
        this.applyFontSize();
        this.savePreferences();
    }

    applyFontSize() {
        document.documentElement.style.fontSize = `${this.fontSize}px`;
    }

    toggleHighContrast() {
        this.highContrast = !this.highContrast;
        this.applyHighContrast();
        this.savePreferences();
    }

    applyHighContrast() {
        document.body.classList.toggle('high-contrast', this.highContrast);
    }
}

window.accessibility = new Accessibility();

window.increaseFontSize = () => window.accessibility.increaseFontSize();
window.decreaseFontSize = () => window.accessibility.decreaseFontSize();
window.fontOriginal = () => window.accessibility.fontOriginal();
window.toggleHighContrast = () => window.accessibility.toggleHighContrast();