export const useComputeSelectedOption = (arrayValue, arrayName) => {
  if (arrayValue === null || arrayValue === undefined) {
      return null;
  }
  return arrayName.value.find(option => option.id === arrayValue) || null;
};
