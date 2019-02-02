export const getAchievementById = (state) => (id) => {
    return state.achievements.List.find(a => a.ID === id);
};

export default {
    getAchievementById
};
