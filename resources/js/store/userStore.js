import {reactive} from "vue";

export function useUserStore() {
    const state = reactive({
        user: null,
    });

    const setUser = (user) => {
        state.user = user;
    };

    return {
        state,
        setUser,
    };
}
