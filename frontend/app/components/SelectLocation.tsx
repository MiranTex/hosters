"use client";
import { Select, SelectItem } from '@nextui-org/select'
import React from 'react'

function SelectLocation({locations, handleChange}: {locations: any[], handleChange: (event: React.ChangeEvent<HTMLSelectElement>) => void}) {

    return (
        <div>
            <Select
                color='primary'
                radius='sm'
                aria-label='Select a Location'
                name="location"
                items={locations}
                label="Locations"
                placeholder="All Locations"
                className="max-w-xs mt-2"
                onChange={handleChange}
            >
                <SelectItem key={'all'} value=''>All Locations</SelectItem>
                {locations.map((location, index) => <SelectItem  key={location}>{location}</SelectItem>)}
            </Select>
        </div>
    )
}

export default SelectLocation