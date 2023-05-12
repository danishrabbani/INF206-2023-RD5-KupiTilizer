@extends('layouts.dashboardLayout')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="/<?php echo Auth::user()->role?>" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-leaf md:ml-2 dark:text-gray-400 dark:hover:text-white">Manage User</a>
    </div>
</li>
@endsection


@section('content')

    <!-- Success Alert  -->
    @if(session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{session('success')}}
        </div>
    @elseif(session()->has('failed'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{session('failed')}}
        </div>
    @endif
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:p-4 text-gray-700 border border-gray-200 bg-gray-50">
        <div class="flex justify-end">

            <!-- Cari User -->
            <!-- <div class="flex items-center justify-between py-4 px-4 sm:px-auto">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Nama User">
                </div>
            </div> -->

            <!-- Button tambahkan user -->
            <div class="py-4 px-4 justify-self-end">
                <button type="button" data-modal-target="tambah-modal" data-modal-toggle="tambah-modal" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-leaf focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-leaf-700">Tambah User</button>
            </div>

        </div>

        <div class="relative overflow-x-auto shadow-lg sm:rounded-xl border-gray-50 border-3">
            <!-- Tabel user -->
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-1/4">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            E-Mail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Memunculkan setiap user -->
                    @foreach($users as $item)
                    <tr class="bg-white hover:bg-gray-50 rounded-xl">

                        <!-- Menampilkan Nama -->
                        <th scope="col" class="px-6 py-3 w-1/4">{{ $item-> name }} </th>

                        <!-- Menampilkan email -->
                        <th scope="col" class="px-6 py-3">{{ $item-> email}} </th>

                        <!-- Menampilkan Action button -->
                        <td class="px-6 py-4 flex gap-1">

                            <!-- Edit button -->
                            <form action="/<?php echo Auth::user()->role?>/manageuser/edit/{{ $item->email }}" method="get" class='d-inline'>
                                @method('get')
                                @csrf
                                <button type="submit" class="mb-px w-full text-white bg-leaf font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
                            </form>

                            <!-- Delete button -->
                            <form action="/<?php echo Auth::user()->role?>/manageuser/delete/{{ $item->email }}" method="post" class='d-inline'>
                                @method('delete')
                                @csrf
                                <button type="submit" class="mb-px w-full text-white bg-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center" onclick="return confirm('Apakah anda yakin menghapus user ini?')">Hapus</button>
                            </form> 

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>    
@endsection


<!-- Tambah data modal -->
<div id="tambah-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="tambah-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <!-- Judul Modal -->
                <h3 class="mb-4 text-xl text-center font-medium text-gray-900 dark:text-white">Tambahkan Akun</h3>
                <!-- Form add user -->
                <form class="space-y-6" method="POST" action="/<?php echo Auth::user()->role?>/manageuser">
                    @csrf
                    <div>
                        <!-- Nama -->
                        <div class="my-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="name" name="name" id="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Lengkap Anda" required>
                        </div>

                        <!-- Email -->
                        <div class="my-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        </div>

                        <!-- Password -->
                        <div class="my-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="@error('password') is-invalid @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <p class = "mt-1 text-sm text-red-500">*Minimal 8 digit</p>
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" id="password" placeholder="••••••••" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required autocomplete = "new-password">
                        </div>

                    </div>

                    <!-- Button submit -->
                    <button type="submit" class="mb-px w-full text-white bg-leaf focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan Akun</button>
                </form>
            </div>
        </div>
    </div>
</div> 


