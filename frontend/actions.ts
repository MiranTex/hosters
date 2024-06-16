"use server";


export async function getFilters() {
    const res = await fetch("http://hosters-backend:8080/api/v1/filters");
    const filters = await res.json();
    return {
        filters
    };
}

// export async function getServers() {

//     const res = await fetch("http://hosters-backend:8080/api/v1/hosters");
//     const data = await res.json();
    
//     return {
//         data
//     };

// }

export async function getFilteredServers(location: string, diskType: string, ramCapcity: Array<any>, RamType: Array<any>, storage: Array<any>, page:number=1) {
    let urlBase = "http://hosters-backend:8080/api/v1/hosters?";
    let query = ''
    if(location && location != '' && location != 'all'){
        query += `&location[eq]=${location}`;
    }

    if(diskType && diskType != '' && diskType != 'all'){
        query += `&diskType[eq]=${diskType}`;
    }

    if(ramCapcity.length > 0){
        query += `&ramCapacity[in]=${ramCapcity.join(',')}`;
    }

    if(RamType.length > 0){
        query += `&ramType[in]=${RamType.join(',')}`;
    }

    if(storage.length > 0){
        query += `&storage[gte]=${storage[0]}`;
    }

    if(storage.length > 0){
        query += `&storage[lte]=${storage[1]}`;
    }

    if(page){
        query += `&page=${page}`;
    }

    const url = new URL(`${urlBase}${query}`);
    console.log(url);

    const res = await fetch(url);
    let data = await res.json();

    
    data = data.data;

    //if data is object, convert it to array
    // console.log(''typeof data);
    

    if(data && typeof data === 'object'){
        data = Object.values(data)
    }

    return {
        data
    };
}   