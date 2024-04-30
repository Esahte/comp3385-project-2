import { useRouter } from "vue-router";

export function formatPrice(price) {
    return Number(price).toLocaleString();
}

export const  viewCarDetails = (id) => {
    const router = useRouter();
    // Programmatically navigate to CarDetails route with the id
    router.push(`/cars/${id}`);
}
