export const useGetTime = () => {
    return new Date().toLocaleTimeString("es-ES", { hour: "2-digit", minute: "2-digit" });
};