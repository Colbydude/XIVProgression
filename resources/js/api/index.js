/**
 * Get all character progression data from the API.
 *
 * @param  {String}  name
 * @param  {String}  server
 * @param  {Object=} params
 * @return {Promise}
 */
export const fetchProgression = (name, server, params = {}) => {
    return window.axios.get(`/api/fetch`, {
        params: {
            name,
            server,
            ...params
        }
    });
};


export default {
    fetchProgression
};
