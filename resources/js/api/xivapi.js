import axios from 'axios';

const XIVAPI_KEY = process.env.MIX_XIVAPI_KEY;

// Create a separate instance of axios to set the base URL and remove global headers.
let instance = axios.create({
    baseURL: 'https://xivapi.com',
});

delete instance.defaults.headers.common['X-Requested-With'];
delete instance.defaults.headers.common['X-CSRF-TOKEN'];

/**
 * Fetches character information from the XIVAPI.
 *
 * @param  {Number}  characterId
 * @param  {Object=} params
 * @return {Promise}
 */
export const character = (characterId, params = {}) => {
    return instance.get(`/character/${characterId}`, {
        params: {
            key: XIVAPI_KEY,
            ...params
        }
    });
};

/**
 * Searchs for an existing character on the XIVAPI.
 *
 * @param  {String}  name
 * @param  {String}  server
 * @param  {Object=} params
 * @return {Promise}
 */
export const characterSearch = (name, server, params = {}) => {
    return instance.get(`/character/search`, {
        params: {
            key: XIVAPI_KEY,
            name,
            server,
            ...params
        }
    });
};

export default {
    character,
    characterSearch
};
