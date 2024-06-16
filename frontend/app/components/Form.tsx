"use client";

import React, { useEffect } from 'react'
import CheckboxGroups from './CheckBoxes'
import SelectDisk from './SelectDisk'
import SelectLocation from './SelectLocation'
import SliderStorage from './SliderStorage';



function Form(
    { 
        locations, 
        disks, 
        setRamCapacity, 
        setRamType, 
        rams, 
        storage,
        setLocation, 
        setDisk, 
        setStorage
    }
    : 
    { 
        locations: Array<string>,
        disks: Array<string>, 
        rams: Object, 
        storage: Array<any>,
        setLocation: any, 
        setDisk: any, 
        setRamType: any 
        setRamCapacity: any
        setStorage: any
    }) {
    const handleChangeStorage = (value: []) => {
        setStorage(value);
    }

    const handleChangeCapacity = (event: React.ChangeEvent<HTMLInputElement>) => {
        const {value, checked} = event.target

        if(checked){
            setRamCapacity((prevState:any) => {
                return[...prevState, value]
            });
        }else{
            return setRamCapacity((prevState:any)=>{
                return prevState.filter((option:any) => option !== value)
            })

        }
    }

    const handleChangeType = (event: React.ChangeEvent<HTMLInputElement>) => {
        const {value, checked} = event.target

        if(checked){
            setRamType((prevState:any) => {
                return[...prevState, value]
            });
        }else{
            return setRamType((prevState:any)=>{
                return prevState.filter((option:any) => option !== value)
            })

        }
    }

    const handleChangeLocation = (event: React.ChangeEvent<HTMLSelectElement>) => {
        setLocation(event.target.value);
    }

    const handleChangeDisk = (event: React.ChangeEvent<HTMLSelectElement>) => {
        setDisk(event.target.value);
    }


    return (
        <div className='flex flex-col gap-y-4'>
            {/* <form onSubmit={handleSubmit}> */}
            {/* storage */}
            <div>
                <SliderStorage value={storage} handleChange={handleChangeStorage} />
            </div>

            {/* ram */}
            <div>
                {/* <h4>SelectRam</h4> */}
                <CheckboxGroups key={"obulbaca"} ram={rams} handleChangeType={handleChangeType} handleChangeCapacity={handleChangeCapacity} />
            </div>

            {/* hard disk type & Location */}
            <div className='w-full'>
                <label className="text-sm text-neutral-400">Hard disk type</label>
                <SelectDisk handleChange={handleChangeDisk} disks={disks} />
                <SelectLocation handleChange={handleChangeLocation} locations={locations} />
            </div>

            {/* </form> */}
        </div>
    )
}

export default Form