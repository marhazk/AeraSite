/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RoleDataPair extends Rpc.Data
/*    */ {
/*    */   public RoleId key;
/*    */   public byte overwrite;
/*    */   public GRoleData value;
/*    */ 
/*    */   public RoleDataPair()
/*    */   {
/* 16 */     this.key = new RoleId();
/* 17 */     this.value = new GRoleData();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.key);
/* 23 */     os.marshal(this.overwrite);
/* 24 */     os.marshal(this.value);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     os.unmarshal(this.key);
/* 31 */     this.overwrite = os.unmarshal_byte();
/* 32 */     os.unmarshal(this.value);
/* 33 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 40 */       RoleDataPair o = (RoleDataPair)super.clone();
/* 41 */       o.key = ((RoleId)this.key.clone());
/* 42 */       o.value = ((GRoleData)this.value.clone());
/* 43 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 46 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RoleDataPair
 * JD-Core Version:    0.6.2
 */