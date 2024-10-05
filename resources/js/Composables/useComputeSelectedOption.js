export const useComputeSelectedOption = (arrayValue, arrayName) => {
    return arrayName.value.find(option => option.id === arrayValue) || null;
  };