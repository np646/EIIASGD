import { defineStore } from 'pinia';

export const useModuleStore = defineStore('module', {
    state: () => ({
        moduleId: null,
    }),
    actions: {
        setModuleId(id) {
            this.moduleId = id;
        },
    },
    persist: true, 
});