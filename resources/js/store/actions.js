import { character } from './../api/xivapi';

export const getCharacterData = async ({ commit, state }, characterId) => {
    const prevAchievements = state.achievements;
    const prevCharacter = state.character;

    commit('setAchievements', null);
    commit('setCharacter', null);
    commit('setStatus', 'loading');

    try {
        const response = await character(characterId, {
            columns: [
                'Achievements', 'Character.ActiveClassJob', 'Character.ClassJobs',
                'Character.ID', 'Character.Name', 'Character.Portrait',
                'Character.Server', 'Character.Title', 'Info'
            ].join(','),
            data: 'AC',
            extended: 1
        });

        commit('setAchievements', response.data.Achievements);
        commit('setCharacter', response.data.Character);
        commit('setStatus', 'successful');
    } catch (e) {
        commit('setAchievements', prevAchievements);
        commit('setCharacter', prevCharacter);
        commit('setStatus', 'failure');
    }
};

export default {
    getCharacterData
};
