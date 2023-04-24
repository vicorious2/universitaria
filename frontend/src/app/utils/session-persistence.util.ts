const sessionPersistence = {
    delete: (keyName: string) => {
      sessionStorage.removeItem(keyName);
    },
    deleteAll: () => {
      const keys = Object.keys(sessionStorage);
  
      keys.forEach(key => {
        sessionStorage.removeItem(key);
      });
    },
    deleteArray: (keyNames: Array<string>) => {
      keyNames.forEach(key => sessionStorage.removeItem(key));
    },
    get: (keyName: string) => {
      const valueString = sessionStorage.getItem(keyName);
  
      return JSON.parse(valueString || "[]");
    },
    set: (keyName: string, value: Object) => {
      const valueString = JSON.stringify(value);
  
      sessionStorage.setItem(keyName, valueString);
    },
    setRawString: (keyName: string, rawString: string) => {
      sessionStorage.setItem(keyName, rawString);
    },
    // update: (keyName: string, value: Object) => {
    //   const valueKeys = Object.keys(value);
    //   const valueString = sessionStorage.getItem(keyName);
    //   let valueObject = JSON.parse(valueString || "");
  
    //   if (!valueObject) {
    //     valueObject = {};
    //   }
  
    //   for (const key of valueKeys) {
    //     valueObject[key] = value[key];
    //   }
  
    //   sessionStorage.setItem(keyName, JSON.stringify(valueObject));
    // }
  };
  
  const localSessionPersistence = {
    delete: (keyName: string) => {
      localStorage.removeItem(keyName);
    },
    deleteAll: () => {
      const keys = Object.keys(localStorage);
  
      keys.forEach(key => {
        localStorage.removeItem(key);
      });
    },
    deleteArray: (keyNames: Array<string>) => {
      keyNames.forEach(key => localStorage.removeItem(key));
    },
    get: (keyName: string) => {
      const valueString = localStorage.getItem(keyName);
  
      return JSON.parse(valueString || "[]");
    },
    set: (keyName: string, value: Object) => {
      const valueString = JSON.stringify(value);
  
      localStorage.setItem(keyName, valueString);
    },
    setRawString: (keyName: string, rawString: string) => {
      localStorage.setItem(keyName, rawString);
    },
    // update: (keyName: string, value: Object) => {
    //   const valueKeys = Object.keys(value);
    //   const valueString = localStorage.getItem(keyName);
    //   let valueObject = JSON.parse(valueString || "");
  
    //   if (!valueObject) {
    //     valueObject = {};
    //   }
  
    //   for (const key of valueKeys) {
    //     valueObject[key] = value[key];
    //   }
  
    //   localStorage.setItem(keyName, JSON.stringify(valueObject));
    // }
  };
  
  export {
    localSessionPersistence, sessionPersistence
  };
  