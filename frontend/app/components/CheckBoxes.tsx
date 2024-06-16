"use client";

import { CheckboxGroup, Checkbox } from '@nextui-org/checkbox';
import React from 'react';

const rams = {
  ddr3: {
    0: 16,
    1: 32,
    2: 64,
    3: 128,
    4: 256,
    5: 512,
  },
  ddr4: {
    0: 128,
    1: 64,
    2: 16,
    3: 32
  },
  ddr5: {
    0: 256,
    1: 512,
    2: 1024
  }
};

const CheckboxGroups = ({ ram, handleChangeCapacity, handleChangeType }: { ram: Object, handleChangeCapacity: any, handleChangeType: any }) => {

  // console.log(ram);

  // const populateCheckboxes = (options:Object, ramType:string) => {
  //   return Object.entries(options).map(([key, value]) => (
  //     <div className='p-1' key={key}>
  //       <Checkbox onChange={(event)=>handleChange(event,ramType)} type="checkbox" className={`${ramType}`} id={`${ramType}-${key}`} name={`${ramType}-${key}`} value={value} />
  //       <label htmlFor={`${ramType}-${key}`}>{value} GB</label>
  //     </div>
  //   ));
  // };

  // const renderCheckboxGroups = () => {
  //   return Object.entries(ram).map(([ramType, options]) => (
  //     <div key={ramType} className='mt-2 text-sz text-neutral-600'>
  //       <h3>{ramType.toUpperCase()}</h3>
  //       <div className='my-2'>
  //         {populateCheckboxes(options, ramType)}
  //       </div>
  //     </div>
  //   ));
  // };

  return (
    <div className='flex flex-col gap-y-4'>
      {ram.type && ram.capacity && (
        <>
          <div className='flex flex-col gap-y-2'>
            <p className='text-xs font-light text-neutral-500'>Ram Type</p>
            {/* <CheckboxGroup> */}
              {ram.type.map((option: any, index:any) => (
                <div key={`${option}-${index}`} >
                  <Checkbox onChange={handleChangeType} type="checkbox" id={`${option}`} name={`${option}`} value={option} />
                  <label className='text-sm' htmlFor={`${option}`}>{option}</label>
                </div>
              ))}
            {/* </CheckboxGroup> */}
          </div>

          <div className='flex flex-col gap-y-2'>
            <p className='text-xs font-light text-neutral-500'>Capcity</p>
            {/* <CheckboxGroup> */}
              {ram.capacity.map((option: any, index: number) => (
                <div key={`${option}-${index}`} >
                  <Checkbox onChange={handleChangeCapacity} type="checkbox" id={`${option}-${index}`} name={`${option}`} value={option} />
                  <label className='text-sm' htmlFor={`${option}`}>{option} GB</label>
                </div>
              ))}
            {/* </CheckboxGroup> */}
          </div>
        </>
        )}
      {/* {renderCheckboxGroups()} */}
    </div>
  );
};

export default CheckboxGroups;
