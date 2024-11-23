import { defineStore } from 'pinia';

export const usePeriodStore = defineStore('period', {
    state: () => ({
        periodId: null,
    }),
    actions: {
        setPeriodId(id) {
            this.periodId = id;
        },
    },
    persist: true, 
});