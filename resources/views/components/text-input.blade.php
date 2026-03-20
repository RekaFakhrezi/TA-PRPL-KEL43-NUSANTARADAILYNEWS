@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-border-light bg-white/60 backdrop-blur-sm text-ink focus:border-ink focus:ring-ink/10 rounded-xl shadow-sm placeholder-ink-muted']) }}>
