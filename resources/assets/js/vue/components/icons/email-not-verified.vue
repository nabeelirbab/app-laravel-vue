<template>
    <svg width="250px" height="250px" viewBox="0 0 480 480" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>Email verificata</title>
        <desc>una lettera con un marchio di approvazione</desc>
        <defs>
            <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="material_shadow">
                <feOffset dx="0" dy="8" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                <feGaussianBlur stdDeviation="4" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.24 0" type="matrix" in="shadowBlurOuter1"
                    result="shadowMatrixOuter1"></feColorMatrix>
                <feOffset dx="0" dy="0" in="SourceAlpha" result="shadowOffsetOuter2"></feOffset>
                <feGaussianBlur stdDeviation="4" in="shadowOffsetOuter2" result="shadowBlurOuter2"></feGaussianBlur>
                <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.12 0" type="matrix" in="shadowBlurOuter2"
                    result="shadowMatrixOuter2"></feColorMatrix>
                <feMerge>
                    <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                    <feMergeNode in="shadowMatrixOuter2"></feMergeNode>
                    <feMergeNode in="SourceGraphic"></feMergeNode>
                </feMerge>
            </filter>

            <filter id="mail_body_shadow" x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox">
                <feOffset dx="0" dy="-4" in="SourceAlpha" result="shadowOffsetInner1" />
                <feComposite in="shadowOffsetInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1"
                    result="shadowInnerInner1" />
                <feColorMatrix values="0 0 0 0 0.6352941176   0 0 0 0 0.7647058824   0 0 0 0 0.8549019608  0 0 0 1 0"
                    type="matrix" in="shadowInnerInner1" result="shadowInnerColored" />
                <feBlend in2="SourceGraphic" in1="shadowInnerColored" mode="normal" />
            </filter>

            <path id="mail_top_path"
                d="M0.157001562,63.598126 L180,176 L360,63.5 L360,36 C360,16.11 343.89,0 324,0 L36,0 C16.11,0 0.18,16.11 0.18,36 L0.157001562,63.598126 Z" />

            <filter id="mail_top_shadow" x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox">
                <feOffset dx="0" dy="4" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
                <feComposite in="shadowOffsetInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1"
                    result="shadowInnerInner1"></feComposite>
                <feColorMatrix values="0 0 0 0 0.960784314   0 0 0 0 1   0 0 0 0 1  0 0 0 1 0" type="matrix"
                    in="shadowInnerInner1" result="shadowInnerTop"></feColorMatrix>
                <feMerge>
                    <feMergeNode in="SourceGraphic" />
                    <feMergeNode in="shadowInnerTop" />
                </feMerge>
            </filter>
        </defs>

        <ellipse id="bg_circle" fill="#3300ff" cx="240" cy="240" rx="240" ry="240">
            <animate id="bg_circle_loop_rx" attributeName="rx" from="240" to="240" begin="0s" dur="2s" fill="freeze"
                repeatCount="indefinite" calcMode="spline" values="240; 230; 240" keyTimes="0; 0.5; 1"
                keySplines="0.5 0.0 0.5 1; 0.5 0.0 0.5 1" />
            <animate id="bg_circle_loop_ry" attributeName="ry" from="230" to="230" begin="0s" dur="2s" fill="freeze"
                repeatCount="indefinite" calcMode="spline" values="230; 240; 230" keyTimes="0; 0.5; 1"
                keySplines="0.5 0.0 0.5 1; 0.5 0.0 0.5 1" />
        </ellipse>

        <g id="mail_recenter_group" transform="translate(240, 240)">
            <g id="mail_rotate_group">
                <g id="mail_rescale_group" transform="scale(0, 0)">
                    <g id="mail_pivot_group" transform="translate(-180, -144)">

                        <g id="mail_body_shadow_group" filter="url(#material_shadow)">
                            <rect id="mail_body" x="0" y="0" width="360" height="288" rx="36" fill="#E7F0F5"
                                filter="url(#mail_body_shadow)" />
                        </g>
                        <path id="long_shadow"
                            d="M346.53273,280.082956 L180,176 L359.525271,30.1357171 C359.837597,32.0440524 360,34.0029734 360,36 L360,252 C360,263.359577 354.745271,273.486202 346.53273,280.082956 Z"
                            fill-opacity="0.05" fill="#004B70" />
                        <use id="mail-top" fill="#EBF6FB" fill-rule="evenodd" xlink:href="#mail_top_path"
                            filter="url(#mail_top_shadow)" />
                        <polygon id="mail_top_border_fat" fill="#BFDBE5"
                            points="360 63.5 180 176 0.157001562 63.598126 0.176645458 40.0254506 180 152.415047 360 39.9150472 360 63.5" />
                        <polygon id="mail_top_border_thin" fill="#92C8D6"
                            points="360 63.5 180 176 0.157001562 63.598126 0.160930341 58.8835909 180 171.283009 360 58.7830094 360 63.5" />
                        <!-- EXCLAMATION MARK -->
                        <text x="270" y="240" font-size="120" font-weight="bold" fill="#FFA500">!</text>
                    </g>
                    <!-- Animate the email scale -->
                    <animateTransform id="mail_appear_scale" attributeName="transform" type="scale" additive="replace"
                        from="0 0" to="1 1" begin="1.6s" dur="0.675s" fill="freeze" repeatCount="1" calcMode="spline"
                        values="0 0; 1.1 1.1; 0.95 0.95; 1 1" keyTimes="0; 0.33; 0.66; 1"
                        keySplines="0.0 0.0 0.5 1; 0.5 0.0 0.5 1; 0.5 0.0 0.2 1" />
                </g>

                <!-- Animate the email rotation -->
                <animateTransform id="mail_rotation_loop" attributeName="transform" type="rotate" from="0 0 0" to="360 0 0"
                    dur="1.35s" repeatCount="indefinite" calcMode="spline" values="2.5 0 0;-2.5 0 0; 2.5 0 0"
                    keyTimes="0; 0.5; 1" keySplines="
                0.5 0.0 0.5 1;
                0.5 0.0 0.5 1" />
            </g>
        </g>
    </svg>
</template>
