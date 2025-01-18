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

    const worksheet = XLSX.utils.json_to_sheet(filteredData);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Reporte");

    // Export to Excel file
    XLSX.writeFile(workbook, "reporte.xlsx");
};

export default useExportExcel;
