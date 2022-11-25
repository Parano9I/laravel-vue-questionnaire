const getItem = (key: string): null | object => {
  const data = localStorage.getItem(key);

  if (!data) return null;

  return JSON.parse(data);
};

const setItem = (key: string, value: object): void => {
  localStorage.setItem(key, JSON.stringify(value));
};

export default {
  getItem,
  setItem,
};
