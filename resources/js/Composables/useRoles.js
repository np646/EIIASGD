import { usePage } from "@inertiajs/vue3";

export function useRoles() {
    const { props } = usePage();

    const hasRole = (requiredRoles) => {
        if (!props.auth?.user?.roles) {
            return false;
        }

        const userRoles = props.auth.user.roles;
        const roles = Array.isArray(requiredRoles) ? requiredRoles : [requiredRoles];

        return roles.some((role) => userRoles.includes(role));
    };
    const getAllRoles = () => {
        return props.auth?.user?.roles || [];
    };

    const hasAllRoles = (requiredRoles) => {
        if (!props.auth?.user?.roles) {
            return false;
        }

        const userRoles = props.auth.user.roles;
        const roles = Array.isArray(requiredRoles) ? requiredRoles : [requiredRoles];

        return roles.every((role) => userRoles.includes(role));
    };

    return {
        hasRole,
        hasAllRoles,
        getAllRoles,
    };
}
