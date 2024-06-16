"use client";

import { getFilteredServers, getFilters, getServers } from "@/actions";
import Form from "./components/Form";
import React, { useEffect } from "react";
import { Skeleton } from "@nextui-org/skeleton";
import { m } from "framer-motion";
import { Pagination } from "@nextui-org/pagination";


export default function Home() {
  const [isLoaded, setIsLoaded] = React.useState(true);

  const [servers, setServer] = React.useState([]);
  const [locations, setLocations] = React.useState(['']);
  const [disks, setDisks] = React.useState(['']);
  const [storage, setStorage] = React.useState([]);
  const [rams, setRams] = React.useState({});

  const [location, setLocation] = React.useState('');
  const [disk, setDisk] = React.useState('');
  const [ramCapacity, setRamCapacity] = React.useState([]);
  const [ramType, setRamType] = React.useState([]);

  const [page, setPage] = React.useState(1);
  const [totalPage, setTotalPage] = React.useState(0);


  async function fetchServers() {
    const severs = (await getServers());
    setServer(severs);
  }

  async function fetchFilters() {
    const filters = (await getFilters()).filters;
    setLocations(filters.locations);
    setDisks(filters.hddTypes);
    setRams(filters.ram);
  }

  useEffect(() => {
    fetchFilters();
    // fetchServers();
  }, []);

  useEffect(() => {
    setIsLoaded(true);

    async function FilterServers() {
      const serversF = (await getFilteredServers(location, disk, ramCapacity, ramType, storage, page)).data;

      setServer(serversF);
    }

    FilterServers().then(() => { setIsLoaded(false); })

  }, [location, disk, storage, ramCapacity, ramType, page]);

  return (
    <main className="p-6">
      <div className="flex min-h-10 pb-5 w-full items-center justify-start border-b">
        <h1 className="text-2xl font-bold text-blue-700">HOSTER</h1>
      </div>

      <div className="flex w-full">
        <div className="gap-y-6 w-1/5 lg:w-1/6 h-screen p-2">
          {/* filters */}
          <div className="flex flex-col gap-y-4 mt-4">
            <Form
              locations={locations}
              disks={disks}
              rams={rams}
              storage={storage}
              setStorage={setStorage}
              setRamCapacity={setRamCapacity}
              setRamType={setRamType}
              setLocation={setLocation}
              setDisk={setDisk}

            />
          </div>
        </div>

        {/* divider*/}
        <div className="border"></div>

        {/* results */}
        {/* <div className="flex flex-col justify-between w-full"> */}
        <div className="w-4/5 lg:w-5/6 h-full p-4 mt-4">
          <h3 className="px-4">Results:</h3>
          <label className="px-4 text-sm text-neutral-400" htmlFor="">All filterd results</label>
          <div className="flex w-full items-center justify-end px-4">
            <Pagination onChange={(page) => setPage(page)} showControls total={10} initialPage={1} />
          </div>
          {isLoaded ?
            <div className="p-4 grid grid-cols-2 lg:grid-cols-3 gap-6 mt-6" >

              <div className="w-full">
                <Skeleton className="rounded border w-full">
                  <div className="flex w-full h-24 rounded bg-default-100">
                  </div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border">
                  <div className="flex h-24 rounded bg-default-100"></div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border w-full">
                  <div className="flex w-full h-24 rounded bg-default-100">
                  </div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border">
                  <div className="flex h-24 rounded bg-default-100"></div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border w-full">
                  <div className="flex w-full h-24 rounded bg-default-100">
                  </div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border">
                  <div className="flex h-24 rounded bg-default-100"></div>
                </Skeleton>
              </div>

              <div className="w-full">
                <Skeleton className="rounded border">
                  <div className="flex h-24 rounded bg-default-100"></div>
                </Skeleton>
              </div>

            </div>
            :
            <div className="p-4 grid grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
              {servers.map((item: any, index: number) => (
                <div key={index} className="flex justify-between p-6 border hover:scale-110 hover:shadow-xl cursor-pointer hover:border-blue-500 transition bg-white border-neutral-200 rounded">
                  <div className="w-full">
                    <div className="flex justify-between items-centerw-full">
                      {/* <h1>Server</h1> */}
                      <h3 className="">{item.model}</h3>
                      <p className="text-neutral-600">{item.price.label}</p>
                    </div>
                    <div className="mt-1">
                      <label className="text-neutral-500 text-sm" htmlFor="">{item.storage.label} / {item.ram.label} / {item.location} </label>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          }
        </div>
      </div>
      {/* </div> */}
    </main>
  );
}
