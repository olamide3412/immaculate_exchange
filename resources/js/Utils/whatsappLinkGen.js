// js/utils/whatsappLinkGenerator.js


export function generateWhatappLink(phoneNumber, message = '') {
    const encodedMessage = encodeURIComponent(message);
    return `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
}
