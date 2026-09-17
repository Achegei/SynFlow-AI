@props([
    'label' => 'Example',
    'title' => null,
    'language' => null,
])

<div
    x-data="{
        copied: false,

        async copyContent() {
            const text = this.$refs.copyContent.innerText.trim();

            try {
                await navigator.clipboard.writeText(text);

                this.copied = true;

                setTimeout(() => {
                    this.copied = false;
                }, 1800);
            } catch (error) {
                console.error('Unable to copy content:', error);
            }
        }
    }"
    class="
        my-6
        overflow-hidden
        rounded-2xl
        border
        border-slate-200
        bg-white
        shadow-sm
    "
>

    {{-- ============================================================
         CARD HEADER
    ============================================================= --}}

    <div
        class="
            flex
            items-center
            justify-between
            gap-4
            border-b
            border-slate-200
            bg-slate-50
            px-4
            py-3
            sm:px-5
        "
    >

        <div class="min-w-0">

            <div class="flex flex-wrap items-center gap-2">

                <span
                    class="
                        inline-flex
                        items-center
                        rounded-full
                        bg-blue-50
                        px-2.5
                        py-1
                        text-[11px]
                        font-extrabold
                        uppercase
                        tracking-wide
                        text-[#2F6BFF]
                    "
                >
                    {{ $label }}
                </span>

                @if ($language)

                    <span
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        {{ $language }}
                    </span>

                @endif

            </div>

            @if ($title)

                <h4
                    class="
                        mt-2
                        text-sm
                        font-bold
                        text-[#061638]
                        sm:text-base
                    "
                >
                    {{ $title }}
                </h4>

            @endif

        </div>


        {{-- ========================================================
             COPY BUTTON
        ========================================================= --}}

        <button
            type="button"
            @click="copyContent()"
            class="
                inline-flex
                shrink-0
                items-center
                gap-2
                rounded-xl
                border
                border-slate-200
                bg-white
                px-3
                py-2
                text-xs
                font-bold
                text-[#061638]
                shadow-sm
                transition
                hover:border-blue-200
                hover:bg-blue-50
                hover:text-[#2F6BFF]
                focus:outline-none
                focus:ring-4
                focus:ring-blue-100
            "
        >

            <svg
                x-show="!copied"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 7V5a2 2 0 012-2h7a2 2 0 012 2v7a2 2 0 01-2 2h-2M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h7a2 2 0 002-2v-3M8 7h4a3 3 0 013 3v6"
                />
            </svg>

            <svg
                x-show="copied"
                x-cloak
                class="h-4 w-4 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span x-show="!copied">
                Copy
            </span>

            <span
                x-show="copied"
                x-cloak
                class="text-green-700"
            >
                Copied
            </span>

        </button>

    </div>


    {{-- ============================================================
         COPYABLE CONTENT
    ============================================================= --}}

    <div
        class="
            overflow-x-auto
            bg-[#081426]
            px-5
            py-5
        "
    >

        <pre
            class="
                m-0
                min-w-full
                whitespace-pre-wrap
                break-words
                font-mono
                text-sm
                leading-7
                text-slate-100
            "
        ><code x-ref="copyContent">{{ $slot }}</code></pre>

    </div>

</div>
