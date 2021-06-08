import { fetchProgression } from './../api';

export const getCharacterData = async ({ commit, state }, { name, server }) => {
    const prevAchievements = state.achievements;
    const prevCharacter = state.character;

    commit('setAchievements', null);
    commit('setCharacter', null);
    commit('setStatus', {
        Achievements: { State: 7 },
        Character: { State: 7 }
    });

    try {
        const response = await fetchProgression(name, server);

        commit('setAchievements', response.data.Achievements);
        commit('setCharacter', response.data.Character);

        // If achievements are private or there are no achievements earned.
        if (response.data.Achievements.List.length === 0) {
            commit('setStatus', {
                Achievements: { State: 5 },
                Character: { State: 2 }
            });
        }
        // OK
        else {
            commit('setStatus', {
                Achievements: { State: 2 },
                Character: { State: 2 }
            });
        }
    } catch (e) {
        commit('setAchievements', prevAchievements);
        commit('setCharacter', prevCharacter);

        // 404 response, couldn't find character.
        if (e.response != null && e.response.status === 404) {
            commit('setStatus', {
                Achievements: { State: -1 },
                Character: { State: 3 }
            });
        }
        // Unknown error occurred.
        else {
            commit('setStatus', {
                Achievements: { State: 9 },
                Character: { State: 9 }
            });
        }
    }
};

export default {
    getCharacterData
};
