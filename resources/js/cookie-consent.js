// Cookie Consent Management
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
    }

    // Check if user has already given consent
    hasConsent() {
        return this.getCookie(this.cookieName) !== null;
    }

    // Save consent preferences
    saveConsent(preferences = {}) {
        const consentData = {
            ...this.consentTypes,
            ...preferences,
            timestamp: new Date().toISOString()
        };
        
        this.setCookie(this.cookieName, JSON.stringify(consentData), this.cookieExpiry);
        console.log('Preferences saved:', consentData); // Debug log
    }

    // Get consent preferences
    getConsent() {
        const consent = this.getCookie(this.cookieName);
        return consent ? JSON.parse(consent) : null;
    }

    // Set cookie
    setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }

    // Get cookie
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

    // Delete cookie
    deleteCookie(name) {
        this.setCookie(name, '', -1);
    }
}

// Initialize cookie consent
window.cookieConsent = new CookieConsent();

// Handle cookie consent UI
document.addEventListener('alpine:init', () => {
    Alpine.data('cookieConsent', () => ({
        showBanner: true,
        showSettings: false,
        preferences: {
            necessary: true,
            analytics: false,
            marketing: false,
            preferences: false
        },

        init() {
            // Carregar preferências salvas
            const savedPreferences = localStorage.getItem('cookiePreferences');
            if (savedPreferences) {
                this.preferences = JSON.parse(savedPreferences);
                this.showBanner = false;
            }
        },

        acceptAll() {
            this.preferences = {
                necessary: true,
                analytics: true,
                marketing: true,
                preferences: true
            };
            this.savePreferences();
            this.showBanner = false;
        },

        openSettings() {
            this.showSettings = true;
            this.showBanner = false;
        },

        closeSettings() {
            this.showSettings = false;
            if (!this.hasConsent()) {
                this.showBanner = true;
            }
        },

        savePreferences() {
            localStorage.setItem('cookiePreferences', JSON.stringify(this.preferences));
            this.showSettings = false;
            this.showBanner = false;
        },

        hasConsent() {
            return Object.values(this.preferences).some(value => value === true);
        }
    }));
}); 