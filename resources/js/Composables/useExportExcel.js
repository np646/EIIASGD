import * as XLSX from "xlsx";

const useExportExcel = (items, columnMapping) => {
    if (!items || items.length === 0) {
        alert("No existen datos disponibles para exportar.");
        return;
    }

    const filteredData = items.map((item) => {
        const mapped = {};
        Object.keys(columnMapping).forEach((key) => {
            mapped[columnMapping[key]] = item[key];
        });
        return mapped;
    });

    const currentDate = new Date().toLocaleDateString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
    const headers = [
        ["PONTIFICIA UNIVERSIDAD CATÓLICA DEL ECUADOR SEDE IBARRA"], 
        ["ESCUELA DE INFORMÁTICA E INTELIGENCIA ARTIFICIAL"], 
        [`Reporte generado el: ${currentDate}`],
    ];

    const jsonData = [
        Object.keys(filteredData[0]),
        ...filteredData.map((row) => Object.values(row)),
    ];

    const finalData = [...headers, ...jsonData];

    const worksheet = XLSX.utils.aoa_to_sheet(finalData);

    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Reporte");

    XLSX.writeFile(workbook, "reporte.xlsx");
};

export default useExportExcel;
