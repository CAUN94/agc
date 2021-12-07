<div class="relative " x-data="{ dropdownTeam: false}" disabled x-cloack>
                        <a
                            class="cursor-not-allowed {{ Request::is('team') ? 'selected' : '' }}"
                            {{-- @click="dropdownTeam = !dropdownTeam" --}}
                            @click="dropdownTeam = dropdownTeam"
                            @keydown.escape="dropdownTeam = false"

                        >
                            Nosotros
                        </a>
                        <ul x-show="dropdownTeam"
                        @click.away="dropdownTeam = false"
                        x-cloak
                        class="drop-nav"
                        >
                            <li>
                                <a href="/team" class="drop-link">
                                    <span class="drop-span">Equipo</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="drop-link">
                                    <span class="drop-span">Alianzas</span>
                                </a>
                            </li>
                        </ul>
                </div>
