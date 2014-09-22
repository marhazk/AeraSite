/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GRolePocket extends Rpc.Data
/*    */ {
/*    */   public int capacity;
/*    */   public int timestamp;
/*    */   public int money;
/*    */   public Rpc.Data.DataVector items;
/*    */   public int reserved1;
/*    */   public int reserved2;
/*    */ 
/*    */   public GRolePocket()
/*    */   {
/* 19 */     this.items = new Rpc.Data.DataVector(new GRoleInventory());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.capacity);
/* 25 */     os.marshal(this.timestamp);
/* 26 */     os.marshal(this.money);
/* 27 */     os.marshal(this.items);
/* 28 */     os.marshal(this.reserved1);
/* 29 */     os.marshal(this.reserved2);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 35 */     this.capacity = os.unmarshal_int();
/* 36 */     this.timestamp = os.unmarshal_int();
/* 37 */     this.money = os.unmarshal_int();
/* 38 */     os.unmarshal(this.items);
/* 39 */     this.reserved1 = os.unmarshal_int();
/* 40 */     this.reserved2 = os.unmarshal_int();
/* 41 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 48 */       GRolePocket o = (GRolePocket)super.clone();
/* 49 */       o.items = ((Rpc.Data.DataVector)this.items.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRolePocket
 * JD-Core Version:    0.6.2
 */