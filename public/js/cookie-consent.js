class CookieConsent {
    constructor() {
        this.cookieName = 'sisuni_consent';
        this.cookieExpiry = 365; // days
        this.consentTypes = {
            necessary: true, // Always true
            analytics: false,
            marketing: false,
            preferences: false
        };

        this.init();
    }

    init() {
        // Ensure Alpine.js is loaded before initializing
        document.addEventListener('alpine:init', () => {
            Alpine.data('cookieConsent', () => ({
                showBanner: !this.hasConsent(),
                showSettings: false,

                init() {
                    const savedConsent = this.getConsent();
                    if (savedConsent) {
                        this.showBanner = false;
                        Object.entries(savedConsent).forEach(([key, value]) => {
                            const checkbox = document.querySelector(`input[name="${key}"]`);
                            if (checkbox && key !== 'timestamp') {
                                checkbox.checked = value;
                            }
                        });
                    }
                },

                acceptAll: () => {
                    this.saveConsent({
                        analytics: true,
                        marketing: true,
                        preferences: true
                    });
                    Alpine.store('cookieConsent').showBanner = false;
                    Alpine.store('cookieConsent').showSettings = false;
                },

                savePreferences: () => {
                    const preferences = {};
                    document.querySelectorAll('.cookie-checkbox').forEach(checkbox => {
                        if (checkbox.name !== 'necessary') {
                            preferences[checkbox.name] = checkbox.checked;
                        }
                    });
                    this.saveConsent(preferences);
                    Alpine.store('cookieConsent').showBanner = false;
                    Alpine.store('cookieConsent').showSettings = false;
                },

                openSettings: () => {
                    Alpine.store('cookieConsent').showBanner = false;
                    Alpine.store('cookieConsent').showSettings = true;
                },

                closeSettings: () => {
                    Alpine.store('cookieConsent').showSettings = false;
                    if (!this.hasConsent()) {
                        Alpine.store('cookieConsent').showBanner = true;
                    }
                }
            }));
        });
    }

    hasConsent() {
        return this.getCookie(this.cookieName) !== null;
    }

    saveConsent(preferences = {}) {
        const consentData = {
            ...this.consentTypes,
            ...preferences,
            timestamp: new Date().toISOString()
        };
        this.setCookie(this.cookieName, JSON.stringify(consentData), this.cookieExpiry);
    }

    getConsent() {
        const consent = this.getCookie(this.cookieName);
        return consent ? JSON.parse(consent) : null;
    }

    setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    deleteCookie(name) {
        this.setCookie(name, '', -1);
    }
}

// Initialize cookie consent
window.cookieConsent = new CookieConsent();