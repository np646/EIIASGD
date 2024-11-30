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
    BIconCaretDownSquareFill,
    BIconPersonCheckFill
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
                { href: "/reviewers", text: "Evaluadores", icon: markRaw(BIconPersonCheckFill) },
                { href: "/graduation/documents/periods", text: "Documentos", icon: markRaw( BIconFileEarmarkTextFill) },
                { href: "/statistics/graduation", text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
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
