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
                { href: "/by-students", text: "Por estudiante", icon: markRaw(BIconFileEarmarkPersonFill) },
                { href: "/by-period", text: "Por periodo", icon: markRaw(BIconCalendarWeekFill) },
                { href: "/graduation/reviewers", text: "Evaluadores", icon: markRaw(BIconPersonCheckFill) },
                { href: "/graduation/documents/periods", text: "Documentos", icon: markRaw(BIconFileEarmarkTextFill) },
                { href: "/graduation/statistics", text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
            ],
        },
        {
            href: "",
            text: "Prácticas",
            icon: markRaw(BIconSuitcaseLgFill),
            subItems: [
                { href: "/community", text: "Vinculación", icon: markRaw(BIconPersonRaisedHand) },
                { href: "/preprofessional", text: "Preprofesionales", icon: markRaw(BIconPersonWorkspace) },
            ],
        },
        { id: "configuracion", href: route("settings.index"), text: "Configuración", icon: markRaw(BIconGearFill) },
    ]);
};
