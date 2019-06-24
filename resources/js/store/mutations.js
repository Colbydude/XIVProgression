export const setAchievements = (state, achievements) => {
    state.achievements = achievements;
};

export const setCharacter = (state, character) => {
    state.character = character;
};

export const setStatus = (state, status) => {
    state.status = status;
};

export const toggleExpansionFilter = (state, filter) => {
    let selectedFilters = [...state.filters.expansion];

    if (selectedFilters.includes(filter)) {
        selectedFilters = selectedFilters.filter(item => item != filter);
    } else {
        selectedFilters.push(filter);
    }

    state.filters.expansion = selectedFilters;
};

export default {
    setAchievements,
    setCharacter,
    setStatus,
    toggleExpansionFilter
};
