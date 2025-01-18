import { reactive, markRaw } from "vue";
import { usePage } from "@inertiajs/vue3";
import {
    BIconHouseDoorFill,
    BIconPersonFill,
    BIconPeopleFill,
    BIconMortarboardFill,
    BIconSuitcaseLgFill,
    BIconClipboardDataFill,
    BIconGearFill,
    BIconPersonWorkspace,
    BIconPersonRaisedHand,
    BIconPersonCheckFill,
    BIconCalendarWeekFill,
    BIconFileEarmarkPersonFill,
} from "bootstrap-icons-vue";

export const useMenuItems = () => {
    const { props } = usePage();
    const hasRole = (requiredRoles) => {
        const userRoles = props.auth.user.roles;
        const roles = Array.isArray(requiredRoles) ? requiredRoles : [requiredRoles];
        return roles.some((role) => userRoles.includes(role));
    };

    const baseMenuItems = reactive([
        {
            id: "inicio",
            href: "/inicio",
            text: "Inicio",
            icon: markRaw(BIconHouseDoorFill),
            roles: ["admin", "titulacion", "practicas", "asistente", "director"],
        },
        {
            id: "estudiantes",
            href: "/estudiantes",
            text: "Estudiantes",
            icon: markRaw(BIconPersonFill),
            roles: ["admin", "titulacion", "practicas", "asistente", "director"],
        },
        {
            id: "docentes",
            href: "/docentes",
            text: "Docentes",
            icon: markRaw(BIconPeopleFill),
            roles: ["admin", "titulacion", "practicas", "asistente", "director"],
        },
        {
            href: "",
            text: "Titulación",
            icon: markRaw(BIconMortarboardFill),
            roles: ["admin", "titulacion", "asistente"],
            subItems: [
                {
                    href: "/titulacion/estudiantes",
                    text: "Por estudiante",
                    icon: markRaw(BIconFileEarmarkPersonFill),
                    roles: ["admin", "titulacion", "asistente"],
                },
                {
                    href: "/titulacion/periodos-academicos",
                    text: "Por periodo",
                    icon: markRaw(BIconCalendarWeekFill),
                    roles: ["admin", "titulacion", "asistente"],
                },
                {
                    href: "/titulacion/evaluadores",
                    text: "Evaluadores",
                    icon: markRaw(BIconPersonCheckFill),
                    roles: ["admin", "titulacion", "asistente"],
                },
            ],
        },
        {
            href: "",
            text: "Vinculación",
            icon: markRaw(BIconPersonRaisedHand),
            roles: ["admin", "practicas", "titulacion"],
            subItems: [
                {
                    href: "/vinculacion/estudiantes",
                    text: "Por estudiante",
                    icon: markRaw(BIconFileEarmarkPersonFill),
                    roles: ["admin", "practicas", "titulacion"],
                },
                {
                    href: "/vinculacion/periodos-academicos",
                    text: "Por periodo",
                    icon: markRaw(BIconCalendarWeekFill),
                    roles: ["admin", "practicas", "titulacion"],
                },
                { href: "/vinculacion/proyectos", text: "Proyectos", icon: markRaw(BIconSuitcaseLgFill), roles: ["admin", "practicas"] },
            ],
        },
        {
            href: "",
            text: "Laborales",
            icon: markRaw(BIconPersonWorkspace),
            roles: ["admin", "practicas", "titulacion"],
            subItems: [
                {
                    href: "/laborales/estudiantes",
                    text: "Por estudiante",
                    icon: markRaw(BIconFileEarmarkPersonFill),
                    roles: ["admin", "practicas", "titulacion"],
                },
                {
                    href: "/laborales/periodos-academicos",
                    text: "Por periodo",
                    icon: markRaw(BIconCalendarWeekFill),
                    roles: ["admin", "practicas", "titulacion"],
                },
            ],
        },
        {
            id: "reportes",
            href: "/reportes",
            text: "Reportes",
            icon: markRaw(BIconClipboardDataFill),
            roles: ["admin", "titulacion", "practicas", "asistente", "director"],
        },
        {
            id: "configuracion",
            href: "/configuracion",
            text: "Configuración",
            icon: markRaw(BIconGearFill),
            roles: ["admin"],
        },
    ]);

    const getFilteredItems = () => {
        return baseMenuItems.filter((item) => {
            const hasParentPermission = hasRole(item.roles);
            if (!hasParentPermission) {
                return false;
            }
            if (item.subItems) {
                const filteredSubItems = item.subItems.filter((subItem) => {
                    return hasRole(subItem.roles);
                });

                if (filteredSubItems.length === 0) {
                    return false;
                }
                // Create a new item with only the allowed subitems
                item.subItems = filteredSubItems;
            }
            return true;
        });
    };
    return reactive(getFilteredItems());
};
