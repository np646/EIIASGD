import { reactive, markRaw } from "vue";
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
    BIconFileEarmarkTextFill,
    BIconPersonCheckFill,
    BIconCalendarWeekFill,
    BIconFileEarmarkPersonFill,
} from "bootstrap-icons-vue";

export const useMenuItems = () => {
    return reactive([
        { id: "inbox", href: route("dashboard"), text: "Inicio", icon: markRaw(BIconHouseDoorFill) },
        { id: "estudiantes", href: route("students.index"), text: "Estudiantes", icon: markRaw(BIconPersonFill) },
        { id: "docentes", href: route("professors.index"), text: "Docentes", icon: markRaw(BIconPeopleFill) },
        {
            href: "",
            text: "Titulación",
            icon: markRaw(BIconMortarboardFill),
            subItems: [
                { href:"/titulacion/estudiantes", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: route("graduation.periods"), text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
                { href: route("graduation.reviewers"), text: "Evaluadores", icon: markRaw(BIconPersonCheckFill) },
                { href: route("graduation.statistics"), text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
            ],
        },
        {
            href: "",
            text: "Vinculación",
            icon: markRaw(BIconPersonRaisedHand),
            subItems: [
                { href: "/estudiantes", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
                { href: "/", text: "Proyectos", icon: markRaw(BIconSuitcaseLgFill) },
            ],
        },
        {
            href: "",
            text: "Laborales",
            icon: markRaw(BIconPersonWorkspace),
            subItems: [
                { href: "/", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
            ],
        },
        { id: "configuracion", href: route("settings.index"), text: "Configuración", icon: markRaw(BIconGearFill) },
    ]);
};
