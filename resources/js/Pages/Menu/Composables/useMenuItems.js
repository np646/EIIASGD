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
    BIconEyeFill,
    BIconBookFill,
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
                // { href: "/advisors", text: "Asesores", icon: markRaw(BIconPersonCheckFill) },
                { href: "/studentfiles/A", text: "Asesores", icon: markRaw(BIconPersonCheckFill) },
                { href: "/readers", text: "Lectores", icon: markRaw(BIconBookFill) },
                { href: "/graduation/documents/periods", text: "Documentos", icon: markRaw( BIconFileEarmarkTextFill) },
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
        { id: "reportes", href: "/statistics", text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
        { id: "configuracion", href: route("settings.index"), text: "Configuración", icon: markRaw(BIconGearFill) },
    ]);
};
