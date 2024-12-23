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
        { id: "inicio", href: "/inicio", text: "Inicio", icon: markRaw(BIconHouseDoorFill) },
        { id: "estudiantes", href: "/estudiantes", text: "Estudiantes", icon: markRaw(BIconPersonFill) },
        { id: "docentes", href: "/docentes", text: "Docentes", icon: markRaw(BIconPeopleFill) },
        {
            href: "",
            text: "Titulación",
            icon: markRaw(BIconMortarboardFill),
            subItems: [
                { href: "/titulacion/estudiantes", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/titulacion/periodos-academicos", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
                { href: "/titulacion/evaluadores", text: "Evaluadores", icon: markRaw(BIconPersonCheckFill) },
                { href: "/titulacion/reportes", text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
            ],
        },
        {
            href: "",
            text: "Vinculación",
            icon: markRaw(BIconPersonRaisedHand),
            subItems: [
                { href: "/vinculacion/estudiantes", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/vinculacion/periodos-academicos", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
                { href: "/vinculacion/proyectos", text: "Proyectos", icon: markRaw(BIconSuitcaseLgFill) },
            ],
        },
        {
            href: "",
            text: "Laborales",
            icon: markRaw(BIconPersonWorkspace),
            subItems: [
                { href: "/laborales/estudiantes", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/laborales/periodos-academicos", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
            ],
        },
        { id: "configuracion", href: "/configuracion", text: "Configuración", icon: markRaw(BIconGearFill) },
    ]);
};
