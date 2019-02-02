import xivapi from './xivapi';

/**
 * Search for character information from this app's DB to skip searching via the XIVDB.
 *
 * @param  {String}  name
 * @param  {String}  server
 * @param  {Object=} params
 * @return {Promise}
 */
export const search = (name, server, params = {}) => {
    return window.axios.get(`/api/fetch`, {
        params: {
            name,
            server,
            ...params
        }
    });
};


export default {
    search,
    xivapi
};
