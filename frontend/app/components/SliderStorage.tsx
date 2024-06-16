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
        step={200}
        showSteps
        showTooltip
        minValue={0}
        maxValue={1000}
        onChange={handleChange}
        defaultValue={[0, 1000]}
        // formatOptions={{ style: 'decimal', currency: 'USD'}}
        className="max-w-md"
      />
    </div>
  )
}

export default SliderStorage