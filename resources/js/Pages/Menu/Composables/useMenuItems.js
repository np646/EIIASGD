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
} from "bootstrap-icons-vue";

export const useMenuItems = () => {
    return reactive([
        { id: "inbox", href: route("dashboard"), text: "Inicio", icon: markRaw(BIconHouseDoorFill) },
        { id: "estudiantes", href: route("students.index"), text: "Estudiantes", icon: markRaw(BIconPersonFill) },
        { id: "docentes", href: route("professors.index"), text: "Docentes", icon: markRaw(BIconPeopleFill) },
        { id: "titulacion", href: "/titulacion", text: "Titulación", icon: markRaw(BIconMortarboardFill) },
        {
            href: "",
            text: "Prácticas",
            icon: markRaw(BIconSuitcaseLgFill),
            subItems: [
                { href: "/vinculacion", text: "Vinculación", icon: markRaw(BIconPersonRaisedHand) },
                { href: "/preprofesionales", text: "Preprofesionales", icon: markRaw(BIconPersonWorkspace) },
            ],
        },
        { id: "reportes", href: "/reportes", text: "Reportes", icon: markRaw(BIconClipboardDataFill) },
        { id: "configuracion", href: route("settings.index"), text: "Configuración", icon: markRaw(BIconGearFill) },
    ]);
};
