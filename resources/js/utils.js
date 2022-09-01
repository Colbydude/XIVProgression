import moment from 'moment';

/** @param {string} dateString */
export const formatDate = (dateString) => {
    return moment(dateString).format('MMMM Do YYYY, h:mm a');
};
