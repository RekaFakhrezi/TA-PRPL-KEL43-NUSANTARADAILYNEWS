<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-ink border-2 border-ink rounded-xl font-bold text-sm text-surface uppercase tracking-widest hover:bg-transparent hover:text-ink focus:outline-none focus:ring-2 focus:ring-ink/20 focus:ring-offset-2 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
