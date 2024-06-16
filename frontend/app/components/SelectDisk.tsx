"use client";

import { Select, SelectItem } from '@nextui-org/select'
import React from 'react'

function SelectDisk({disks, handleChange}: {disks: any[], handleChange: (event: React.ChangeEvent<HTMLSelectElement>) => void}) {
    return (
        <div>
            <Select
                color='primary'
                radius='sm'
                aria-label='Select a Disk'
                name="disk"
                items={disks}
                label="Disk type"
                placeholder="All Disks Type"
                className="max-w-xs mt-2"
                onChange={handleChange}
            >
                <SelectItem key={'all'} value=''>All Disks Type</SelectItem>

                {
                disks.map((disk) => 
                    <SelectItem value={disk} key={disk}>
                        {disk}
                    </SelectItem>)}
                
            </Select>
        </div>
    )
}

export default SelectDisk