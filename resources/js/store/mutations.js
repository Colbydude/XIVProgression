export const setAchievements = (state, achievements) => {
    state.achievements = achievements;
};

export const setCharacter = (state, character) => {
    state.character = character;
};

export const setStatus = (state, status) => {
    state.status = status;
};

export default {
    setAchievements,
    setCharacter,
    setStatus
};
