export const getAchievement = (state, getters) => (id) => {
    return state.achievements.List.filter(a => a.ID = id);
};

export default {
    getAchievement
};
