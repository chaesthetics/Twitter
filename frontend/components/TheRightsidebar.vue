<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const toastSuccess = ref("");

defineProps({
    dark:{
        type: Boolean,
    }
});

</script>
<template>
<aside class="sticky top-0">
<div :class="`${dark?'bg-gray-900':'bg-white'} ${dark? 'border-gray-600': ''} space-y-4 h-screen w-full border-l-[1px] pl-8 pr-14 sticky top-0`">
    <div class="w-full relative group">
        <input :class="`${dark ? 'bg-gray-800' : 'bg-gray-100' } ${dark? 'text-white':'text-gray-800'} ${dark? 'placeholder-gray-100':'placeholder-gray-500' } ${dark? 'focus:bg-gray-700' :'focus:bg-white'} ${dark?'focus:ring-gray-600':'focus:ring-sky-300'} pr-6 pl-14 focus:outline-none focus:ring-1  py-[12px] w-full mt-1 rounded-full`" placeholder="Search" type="text" />
        <svg viewBox="0 0 24 24" aria-hidden="true" :class="`${dark ? 'fill-white':'fill-gray-500'} group-focus:fill-sky-400 absolute h-5 w-5 top-[18px] left-5 r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-14j79pv r-4wgw6l r-f727ji`"><g><path d="M10.25 3.75c-3.59 0-6.5 2.91-6.5 6.5s2.91 6.5 6.5 6.5c1.795 0 3.419-.726 4.596-1.904 1.178-1.177 1.904-2.801 1.904-4.596 0-3.59-2.91-6.5-6.5-6.5zm-8.5 6.5c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5c0 1.986-.682 3.815-1.824 5.262l4.781 4.781-1.414 1.414-4.781-4.781c-1.447 1.142-3.276 1.824-5.262 1.824-4.694 0-8.5-3.806-8.5-8.5z"></path></g></svg>
    </div>        
    <div :class="`${dark? 'bg-gray-800':'bg-gray-50'} Subscribe w-full rounded-2xl py-3 px-4 space-y-2`">
        <h1 :class="`${dark? 'text-white':'text-gray-800'} text-xl font-bold`">Subscribe to Premium</h1>
        <p :class="`${dark? 'text-white':'text-black'} leading-5 font-light`">Subscribe to unlock new features and if eligible, receive a share of ads revenue.</p>
        <button :class="`${dark? 'text-black bg-white':'text-white bg-neutral-900 '} font-bold rounded-full px-4 py-2`">Subscribe</button>
    </div>
     <div :class="`${dark? 'bg-gray-800':'bg-gray-50'} Subscribe w-full rounded-2xl py-3 space-y-2 items-center`">
        <h1 :class="`${dark? 'text-white':'text-gray-800'} px-4 text-xl font-bold`">Who to follow</h1>
        <div :class="`px-4 flex hover:cursor-pointer ${dark ? 'hover:bg-gray-700':'hover:bg-gray-100' } py-2 justify-between mt-4 ml-2 items-center`">
            <div class="flex space-x-4 items-center">
                <img src="../assets/images/katy.jpg" class="w-10 h-10 object-cover rounded-full"/>
                <div class="leading-5">
                    <div class="flex space-x-2">
                        <p :class="`${dark?'text-white':'text-black'} font-semibold`">Katty Perry</p>
                        <img class="h-5 w-5" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                    </div>
                    <p :class="`${dark?'text-gray-300':'text-gray-700'} font-light`">@katyperry</p>
                </div>
            </div>
            <button :class="`${dark? 'bg-white text-neutral-800 font-extrabold':'bg-neutral-900 text-white font-bold'} text-sm h-8 px-4 rounded-full`">Follow</button>
        </div>
         <div :class="`px-4 flex hover:cursor-pointer ${dark ? 'hover:bg-gray-700':'hover:bg-gray-100' } py-2 justify-between mt-4 ml-2 items-center`">
            <div class="flex space-x-4 items-center">
                <img src="../assets/images/Emma.jpg" class="w-10 h-10 object-cover rounded-full"/>
                <div class="leading-5">
                    <div class="flex space-x-2">
                        <p :class="`${dark?'text-white':'text-black'} font-semibold`">Emma Raducano</p>
                        <img class="h-5 w-5" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                    </div>
                    <p :class="`${dark?'text-gray-300':'text-gray-700'} font-light`">@EmmaRaducano</p>
                </div>
            </div>
            <button :class="`${dark? 'bg-white text-neutral-800 font-extrabold':'bg-neutral-900 text-white font-bold'} text-sm h-8 px-4 rounded-full`">Follow</button>
        </div>
        <div :class="`px-4 flex hover:cursor-pointer ${dark ? 'hover:bg-gray-700':'hover:bg-gray-100' } py-2 justify-between mt-4 ml-2 items-center`">
            <div class="flex space-x-4 items-center">
                <img src="../assets/images/taylor.jpg" class="w-10 h-10 object-cover rounded-full"/>
                <div class="leading-5">
                    <div class="flex space-x-2">
                        <p :class="`${dark?'text-white':'text-black'} font-semibold`">Taylor Swift</p>
                        <img class="h-5 w-5" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                    </div>
                    <p :class="`${dark?'text-gray-300':'text-gray-700'} font-light`">@taylortwift13</p>
                </div>
            </div>
            <button :class="`${dark? 'bg-white text-neutral-800 font-extrabold':'bg-neutral-900 text-white font-bold'} text-sm h-8 px-4 rounded-full`">Follow</button>
        </div>
        <div :class="`px-4 flex hover:cursor-pointer ${dark ? 'hover:bg-gray-700':'hover:bg-gray-100' } py-2 justify-between mt-4 ml-2 items-center`">
            <p class="text-sky-400">Show more</p>
        </div>
    </div>
    <div class="ml-2">
        <div :class="`${dark? 'text-gray-200':'text-gray-700'} w-11/12 px-2 text-[13px] space-x-2`">
            <a class="hover:underline hover:cursor-pointer">Terms of Service</a>
            <a class="hover:underline hover:cursor-pointer">Privacy Policy</a>
            <a class="hover:underline hover:cursor-pointer">Cookie Policy</a>
        </div>
        <div :class="`${dark? 'text-gray-200':'text-gray-700'} w-11/12 px-2 text-[13px] space-x-2`">
            <a class="hover:underline hover:cursor-pointer">Accessibility</a>
            <a class="hover:underline hover:cursor-pointer">Ads Info</a>
            <a class="hover:underline hover:cursor-pointer">© 2024 Auriel Fernandez</a>
        </div>
    </div>

</div>
</aside>
</template>
<style></style>