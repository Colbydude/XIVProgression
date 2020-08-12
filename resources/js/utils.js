import moment from 'moment';

export const formatDate = (dateString) => {
    return moment(dateString).format('MMMM Do YYYY, h:mm a');
};
