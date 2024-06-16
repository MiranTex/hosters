"use client";

import { Slider, SliderValue } from '@nextui-org/slider'
import React from 'react'

function SliderStorage({handleChange, value = [0,1000]}: {handleChange: any, value: Array<any>}) {
  // const [value, setValue] = React.useState<SliderValue>([0, 5000])
  return (
    <div>
      <label htmlFor='storage' className="text-xs text-neutral-600">Storage Range</label>
      <Slider
        aria-label='storage range slider'
        // value={value}
        name='storage'
        step={1024}
        showSteps
        showTooltip
        minValue={1024}
        maxValue={24576}
        onChange={handleChange}
        defaultValue={[1024, 24576]}
        // formatOptions={{ style: 'decimal', currency: 'USD'}}
        className="max-w-md"
      />
    </div>
  )
}

export default SliderStorage