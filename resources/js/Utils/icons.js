// iconUtils.js
class IconUtils {
   static adminIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zM16.24 6.24l1.42-1.42 3.54 3.54-1.42 1.42-3.54-3.54zM2 6.82l3.54-3.54 1.42 1.42L3.42 8.24 2 6.82zm16.59 9.36l1.42-1.42 3.54 3.54-1.42 1.42-3.54-3.54zM4.24 18.59l3.54-3.54 1.42 1.42-3.54 3.54-1.42-1.42z"/>
                </svg>`;
    }
   static superAdminIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm7.4-5.6l-1.4-1.4L19 5.8l1.4 1.4-1.4 1.4zm-14.8 0L5.8 8.4 7.2 7l1.4 1.4-1.4 1.4zM20 16.6l-1.4 1.4-1.4-1.4L19 15.2l1.4 1.4zM4 16.6l-1.4-1.4L5.8 15l1.4 1.4-1.4 1.4z"/>
                </svg>`;
   }
   static userIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>`;
    }
    static logIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
            <path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h12v2H3v-2z"/>
        </svg>`;
    }

    static clientVerifiedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1.73 14.73l-3.18-3.18 1.41-1.41 1.77 1.77 5.3-5.29 1.41 1.41-6.71 6.7z"/>
                </svg>`;
    }

    static clientUnverifiedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm5.66 13.66l-1.41 1.41L12 13.41l-4.24 4.24-1.41-1.41L10.59 12 6.34 7.76l1.41-1.41L12 10.59l4.24-4.24 1.41 1.41L13.41 12l4.25 4.24z"/>
                </svg>`;
    }

    static clientTotalIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm9.32-1.47l-1.06 1.06c-.49-.35-1.03-.64-1.61-.86l.58-.58c.93-.93.93-2.44 0-3.36l-1.06-1.06c-.93-.93-2.44-.93-3.36 0l-.58.58c-.22-.58-.51-1.12-.86-1.61l1.06-1.06c1.79-1.79 4.7-1.79 6.49 0l1.06 1.06c1.79 1.79 1.79 4.7 0 6.49z"/>
                </svg>`;
    }

    static businessVerifiedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1 15l-4-4 1.41-1.41L11 14.17l4.59-4.59L17 11l-6 6z"/>
                </svg>`;
    }

    static businessUnverifiedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm5 13H7v-2h10v2z"/>
                </svg>`;
    }

    static businessTotalIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-2-9h4v2h-4v-2zm0-4h4v2h-4V7zm0 8h4v2h-4v-2z"/>
                </svg>`;
    }

    static loanPendingIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm1 14h-2v-4h2zm0-6h-2V7h2z"/>
                </svg>`;
    }

    static loanApprovedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 15.59l-4.29-4.3 1.42-1.41L11 14.76l4.87-4.87 1.41 1.41z"/>
                </svg>`;
    }

    static loanDisbursedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M17 1H7a2 2 0 00-2 2v18a2 2 0 002 2h10a2 2 0 002-2V3a2 2 0 00-2-2zm0 18H7V5h10z"/>
                </svg>`;
    }

    static loanRejectedIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm4.95 12.05l-1.41 1.41L12 13.41l-3.54 3.54-1.41-1.41L10.59 12 7.05 8.46l1.41-1.41L12 10.59l3.54-3.54 1.41 1.41L13.41 12z"/>
                </svg>`;
    }

    static loanPaidIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9z"/>
                </svg>`;
    }

    static loanDelinquentIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 15h2v2h-2zm0-12h2v10h-2z"/>
                </svg>`;
    }

    static repaymentDueIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zM11 6h2v6h-2zm0 8h2v2h-2z"/>
                </svg>`;
    }

    static repaymentAmountIcon() {
        return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-1.93 0-3.68-.78-4.95-2.05L16.95 7.05C18.22 8.32 19 10.07 19 12c0 3.87-3.13 7-7 7z"/>
                </svg>`;
    }

  // You can continue adding other icons similarly...
}

export default IconUtils;
