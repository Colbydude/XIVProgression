import { character } from './../api/xivapi';

export const getCharacterData = async ({ commit, state }, characterId) => {
    const prevAchievements = state.achievements;
    const prevCharacter = state.character;

    commit('setAchievements', null);
    commit('setCharacter', null);
    commit('setStatus', {
        Achievements: { State: 7 },
        Character: { State: 7 }
    });

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

        console.log(response.data);

        commit('setAchievements', response.data.Achievements);
        commit('setCharacter', response.data.Character);
        commit('setStatus', {
            Achievements: { State: 2 },
            Character: { State: 2 }
        });
    } catch (e) {
        commit('setAchievements', prevAchievements);
        commit('setCharacter', prevCharacter);
        commit('setStatus', {
            Achievements: { State: 9 },
            Character: { State: 9 }
        });
    }
};

export default {
    getCharacterData
};
