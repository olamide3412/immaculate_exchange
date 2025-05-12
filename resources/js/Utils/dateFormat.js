// js/utils/dateFormat.js

import dayjs from 'dayjs';

export function formatDate(dateString, format = 'ddd, DD-MMM-YYYY') {
    return dayjs(dateString).format(format);
}
